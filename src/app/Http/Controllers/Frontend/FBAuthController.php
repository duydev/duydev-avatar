<?php

namespace DuyDev\Http\Controllers\Frontend;

use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Illuminate\Http\Request;
use DuyDev\Http\Controllers\Controller;
use Facebook\Facebook;
use DuyDev\Repositories\UsersRepository as User;
use Illuminate\Support\Facades\Hash;

class FBAuthController extends Controller
{
    private $user;
    private $fb;
    private $helper;
    private $permissions;
    private $callback_url;

    /**
     * FBAuthController constructor.
     * @param $fb
     */
    public function __construct(User $user)
    {
        session_start(); // fix missing state
        $this->user = $user;
        $this->fb = new Facebook(config('facebook.config'));
        $this->helper = $this->fb->getRedirectLoginHelper();
        $this->permissions = config('facebook.permissions');
        $this->callback_url = route('fbcallback');
    }

    public function login()
    {
        $login_url = $this->helper->getLoginUrl($this->callback_url, $this->permissions);
        return redirect( $login_url );
    }

    public function callback() {
        $access_token = null;
        $success = true;
        $message = 'Đăng nhập thành công.';
        try
        {
            $access_token = $this->helper->getAccessToken();

            if( ! isset( $access_token ) ) {
                $success = false;
                $message = 'Lỗi trong quá trình lấy Access Token.';
            }
            else {
                $oAuth2Client = $this->fb->getOAuth2Client();
                if( ! $access_token->isLongLived() ) {
                    try {
                        $access_token = $oAuth2Client->getLongLivedAccessToken($access_token);
                    } catch (FacebookSDKException $e) {
                        $success = false;
                        $message = 'Lỗi Facebook SDK: '.$e->getMessage();
                    }
                }
            }
        }
        catch (FacebookResponseException $e)
        {
            $success = false;
            $message = 'Lỗi Graph API: '. $e->getMessage();
        }
        catch (FacebookSDKException $e)
        {
            $success = false;
            $message = 'Lỗi Facebook SDK: '.$e->getMessage();
        }

        if( $success ) {
            // Get user data
            try {
                $response = $this->fb->get('/me?fields=id,name,email', $access_token);
                $fbuser = $response->getGraphUser();

                if( $user = $this->user->findBy('fb_id', $fbuser['id'] ) ) {
                    $user->fb_token = $access_token;
                    $user->save();
                } else {
                    $user = $this->user->create([
                        'name' => $fbuser['name'],
                        'email' => $fbuser['email'],
                        'password' => Hash::make(str_random(8)),
                        'fb_id' => $fbuser['id'],
                        'fb_token' => $access_token,
                    ]);
                }

                if( $user ) {
                    auth()->login( $user );
                }
                return redirect()->route('home');

            } catch(FacebookResponseException $e) {
                dd( $e );
                echo 'Graph returned an error: ' . $e->getMessage();
                exit;
            } catch(FacebookSDKException $e) {
                dd( $e );
                echo 'Facebook SDK returned an error: ' . $e->getMessage();
                exit;
            }


        } else {
            return redirect()
                    ->route('fblogin')
                    ->with('success',$success)
                    ->with('message',$message);
        }
    }

}
