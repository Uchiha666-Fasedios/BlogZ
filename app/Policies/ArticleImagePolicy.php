<?php

namespace App\Policies;

use App\ArticleImage;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticleImagePolicy
{
    use HandlesAuthorization;


    public function delete(User $user, ArticleImage $imagen)
    {
        return $user->id === $imagen->article->user_id;  //pregunto si el id del autenticado es igual al id del usuario del articulo de la imagen ..imagen tiene un articulo y el articulo tiene el id del usuario
    }


}
