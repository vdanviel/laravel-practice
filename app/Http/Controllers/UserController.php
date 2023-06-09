<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\UserContract;
use App\Http\Controllers\CepController;
use App\Models\User;
use Dotenv\Validator as Valid;
use Illuminate\Support\Facades\Validator as Validate;
use Illuminate\Auth\Events\Validated;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;

class UserController extends Controller
{
    
    protected function credentialslogin(Request $request){
        return [
            'user_email' => $request->input('email'),
            'password' => $request->input('password'),
        ];
    }

    public function login(Request $request){

        $credentials = $this->credentialslogin($request);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            //usuario entrou
            return redirect()->intended('usuario');
        }else{
            //nao entrou
            return redirect()->back()->withErrors(['erro' => 'Usuário ou senha inválida.']);
        }

    }

    public static function userinfo(){

        //objeto laravel que le as informações do usuario logado
        $userobj = auth()->user();

        //descobrindo a idade do usuario por uma query sql
        $user_age_array = DB::select("SELECT YEAR(CURRENT_DATE) - YEAR(tb_users.user_birthday) as user_age FROM tb_users WHERE tb_users.user_email = ?", [$userobj->user_email]);

        $user_age_obj = (object) $user_age_array;

        $user_data = [
            "name" => $userobj->user_name,
            "email" => $userobj->user_email,
            "age" => $user_age_obj->{'0'}->user_age,
            "birthday" => date('d/m/Y', strtotime($userobj->user_birthday)),
            "state" => $userobj->user_state,
            "city" => $userobj->user_city,
            "neighborhood" => $userobj->user_neighborhood,
            "address_number" => $userobj->user_address_number,
            "address" => $userobj->user_address
        ];

        return $user_data ?? null;
    }

    public function register(Request $request){

        //validação dos dados, caso haja erros
        $validate = $this->validate($request,
            [
                'name' => 'required',
                'email' => 'required|email',
                'birthday' => 'required',
                'password' => 'required',
                'cep' => 'required',
                'adressnumber' => 'required'
            ],
            [
                'name.required' => 'O campo do nome é obrigatório.',
                'email.required' => 'O campo do e-mail é obrigatório.',
                'email.email' => 'O e-mail deve ser válido.',
                'birthday.required' => 'O campo do nascimento é obrigatório.',
                'password.required' => 'O campo da senha é obrigatório.',
                'cep.required' => 'O campo de CEP é obrigatório.',
                'adressnumber.required' => 'O Número de endereço é obrigatório.'
            ]
        );

        try {   

            $cep_info = CepController::cepdata($request->cep);

            //se o cep estiver inválido, já elvis
            if ($cep_info === false) {
                return redirect()->back()->with(['error' => 'Por favor, digite um CEP válido.']);
            }

            //criando o object em tb_users
            $user = new User;
            $user->user_name = $request->name;
            $user->user_email = $request->email;
            $user->user_birthday = $request->birthday;
            $user->user_password = bcrypt($request->password);
            $user->user_cep = $cep_info['cep'];
            $user->user_state = $cep_info['uf'];
            $user->user_city = $cep_info['localidade'];
            $user->user_neighborhood = $cep_info['bairro'];
            $user->user_address_number = $request->adressnumber;
            $user->user_address = $cep_info['logradouro'];
            $user->save();

            //autenticando com o user que foi criado agr
            Auth::login($user);

            //redirecionando pra pagina profiles
            return redirect()->route('profile')->with(['register_success' => 'Você se cadastrou com sucesso!']);

        } catch (\Illuminate\Database\QueryException $e) { // caso ocorra erros no db

            $errorcode = $e->errorInfo[1];

            if ($errorcode == 1062) { 
                return back()->withErrors(['error' => "Falha ao criar usuário, e-mail já existente."]);
            }else{

                return $e;

            }

        } catch (\ErrorException $e) {

            dd($e);

        }
        
    }
}
