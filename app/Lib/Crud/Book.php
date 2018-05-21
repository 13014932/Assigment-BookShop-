<?php


namespace App\Lib\Crud;

use Illuminate\Support\Facades\Log;
use App\Models\Crud\Book as Model;
use Mockery\Exception;


class Book
{

    // for testing PuposeOnly test -tests-
    public static function  sum($a,$b){

        return $c=$a+$b;
    }

    //Method Retrun User Books.
    public function getBooks(): array
    {
        $get_books = Model::all()->toArray();

        if (!empty($get_books)) {
            return $get_books;
        } else {

            return [];
        }


    }

    // method to store NEW BOOK data
    public function storeNewBook($book_data):bool
    {
//          dd($data->id);
        try{
            if (!empty($book_data->id)){
                $id=$book_data->id;
            }
            else{
                $id=0;
            }

            $book = Model::findOrNew($id);
            $book->fill($book_data->all());

            return  $book->save();

        }
        catch (\Exception $e) {
            log::error($e->getMessage() . " => on file " . $e->getFile() . " => on line number = " . $e->getLine());
            return false;

    }


    }


    //method to UPDATE Book  Data.
    public function bookUpdate($data):bool
    {

        $id = Model::find($data->id);

        $updates= $id->fill($data->input())->save();

       // log::info($updates);
           return $updates;


    }

    // method to DELETE Book.
    public function bookDelete($id):bool
    {

       Model::destroy($id);
        return true;
    }

// method to get books to admin books view. (to datatable)
    public function getAPIBooks()
    {


           $quary=Model::select(['id', 'name', 'price', 'special_price', 'author_name', 'book_created_date', 'quantity']);

//            log::info($quary->get()->toArray());
            return $quary;
    }

    // method SUBTRACT  the buying quantity from BOOKS table.
    public function subtractBookQuantity($id,$buyed_book_qty):bool
    {

        $book=  Model::find($id);
        $book_qty = $book->quantity;
//            dd($bookqty);

        $book->quantity = $book_qty - ($buyed_book_qty);

       return $book->save();

    }


}