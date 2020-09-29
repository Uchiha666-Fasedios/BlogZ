<?php

namespace App\Policies;

use App\Article;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any articles.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }


    //si quiero hacer una police q no sea a traves de un usuario autenticado TAMBIEN SE PUEDE
    //public function view(?User $user, Article $articulo) poniendo ?
    public function view(User $user, Article $articulo)//resivo el usuario autenticado y el articulo q quiero ver
    {
        return $user->id === $articulo->user_id;  //si el id del usuario es igual al id del usuario q tiene el articulo eso mira ..y pasa
    }

    /**
     * Determine whether the user can create articles.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the article.
     *
     * @param  \App\User  $user
     * @param  \App\Article  $article
     * @return mixed
     */

    public function edit(User $user, Article $articulo)
    {
        return $user->id === $articulo->user_id;
    }


    public function update(User $user, Article $articulo)
    {
        return $user->id === $articulo->user_id;
    }

    /**
     * Determine whether the user can delete the article.
     *
     * @param  \App\User  $user
     * @param  \App\Article  $article
     * @return mixed
     */
    public function delete(User $user, Article $articulo)
    {
        return $user->id === $articulo->user_id;
    }

    /**
     * Determine whether the user can restore the article.
     *
     * @param  \App\User  $user
     * @param  \App\Article  $article
     * @return mixed
     */
    public function restore(User $user, Article $article)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the article.
     *
     * @param  \App\User  $user
     * @param  \App\Article  $article
     * @return mixed
     */
    public function forceDelete(User $user, Article $article)
    {
        //
    }
}
