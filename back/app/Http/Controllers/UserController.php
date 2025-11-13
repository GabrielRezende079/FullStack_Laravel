<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;
use PhpParser\Node\Stmt\TryCatch;
use Symfony\Component\Mime\Message;
use Termwind\Components\Dd;

class UserController extends Controller
{

    public function index(Request $request) // Get All  <------------
    {
        
        $currentPage = $request->get('current_page') ?? 1;
        $perPage = 3;
        $skip = ($currentPage - 1) * $perPage;
        $users = User::skip($skip)->take($perPage) -> orderByDesc('id')->get();
        
        return response()->json($users->toResourceCollection(), 200);
    }

// php artisan make:request StoreUserRequest
    public function store(StoreUserRequest $request) // Post <------------  // StoreUserRequest é a validação para inserir usuário 
    {
        $data = ($request->validated());

         try {
            $user = new User(); // cria um novo objeto User
            $user->fill($data); // preenche o objeto com os dados validados
            $user ->password = Hash::make('123'); // define uma senha padrão "123"
            $user->save(); // salva o objeto no banco de dados
            return response()->json($user->toResource(), 201);

        } catch (\Exception $ex) {
            return response()->json(['message' => 'Falha ao inserir usuario!'], 400);
        }
    
    }

 
    public function show(string $id) // Get_by_ID <------------
    {
        try {
            $user = User::findOrFail($id);
            return response()->json($user->toResource(), 200);

        } catch (\Exception $ex) {
            return response()->json(['message' => 'Usuario não encontrado!'], 404);
        }
    }

//php artisan make:request UpdateUserRequest 
    public function update(UpdateUserRequest $request, string $id) // Put <------------
    {
        $data = ($request->validated());

         try {
            $user = User::findOrFail($id); // busca o usuário pelo ID
            $user->update($data); // 

            return response()->json($user->toResource(), 200);

        } catch (\Exception $ex) {
            return response()->json(['message' => 'Falha ao atualizar usuario!'], 400);
        }
    }

  
    public function destroy(string $id) // Delete <------------
    {
        
         try {
            $removed = User::destroy($id); // busca o usuário pelo ID 
            if (!$removed) {
                throw new \Exception();
            }
            return response()->json(null, 204);

        } catch (\Exception $ex) {
            return response()->json(['message' => 'Falha ao remover usuario!'], 400);
        }
    }
}
