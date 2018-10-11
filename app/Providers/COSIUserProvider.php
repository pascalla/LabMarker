<?php

namespace App\Providers;

use Illuminate\Auth\EloquentUserProvider as UserProvider;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;

use App\User;

use XPathSelector\Selector;
use XPathSelector\Exception\NodeNotFoundException;

class COSIUserProvider extends UserProvider {

  public function retrieveByCredentials(array $credentials)
  {
      if (!$credentials) {
          return null;
      }

      // Assume we are logging in with a phone number
      return User::where('identifier', $credentials['identifier'])->first();
  }

    public function validateCredentials(UserContract $user, array $credentials)
    {
        $csrf = "";
        $loggedIn = false;

        $client = new \GuzzleHttp\Client();
        $jar = new \GuzzleHttp\Cookie\CookieJar;
        $res = $client->request('GET', 'https://science.swansea.ac.uk/intranet/accounts/login/?next=/intranet/', [
          'cookies' => $jar
        ]);
        $string = $res->getBody();
        $xs = Selector::loadHTML($string);
        $elements = $xs->find('//*[@id="login"]/input/@value');
        foreach($elements as $element){
          $csrf = $element->value;
        }


        $response = $client->request('POST', 'https://science.swansea.ac.uk/intranet/accounts/login/', [
            'form_params' => [
                'username' => $credentials['identifier'],
                'password' => $credentials['password'],
                'csrfmiddlewaretoken' => $csrf
            ],
            'cookies' => $jar
        ]);

        $string = $response->getBody();
        $xs = Selector::loadHTML($string);
        try {
          $elements = $xs->find('//*[@id="logout"]/a[2]');
          return true;
        } catch(NodeNotFoundException $e){
          return false;
        }

    }

}
