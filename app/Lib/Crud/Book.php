<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 21-05-2018
 * Time: 01:27 PM
 */

namespace App\Lib\Crud;

use App\Models\Crud\Book as BookModel;

class Book
{

    public static function createBook($array): BookModel
    {

        $book = new BookModel;
        $book->fill($array);
        $book->save();

        return $book;
    }

    public static function updateBook($array): BookModel
    {

        $book = BookModel::find($array['id']);

        $book = $book->fill($array);

        $book->save();

        return $book;
    }

}