<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use DateTimeImmutable;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\JwtFacade;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;

class RegisterController extends Controller
{
    public function signup(Request $request)
    {
	/* need to make createBearerToken method!!! */
        $key = InMemory::base64Encoded(
    'hiG8DlO3vtih6AxlAn5XKImZ36yu8I3mkOTaJrEuW8yAv8Jnkw330uMt8AEqQ5LB'
	);

        $token = (new JwtFacade())->issue(
            new Sha256(),
            $key,
            static fn (
                Builder $builder,
                DateTimeImmutable $issuedAt
            ): Builder => $builder
                ->issuedBy('https://api.my-awesome-app.io')
                ->permittedFor('https://client-app.io')
                ->expiresAt($issuedAt->modify('+10 minutes'))
	);

	$token = $token->toString();
       
	$user = User::create([
	    'email' => $request->email,
	    'password' => md5($request->password),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'bearerToken' => $token
        ]);

	return response()->json([
		'succees' => true,
		'code' => 201,
		'message' => 'Success',
                'bearer_token' => $token], 201);
    }

}
