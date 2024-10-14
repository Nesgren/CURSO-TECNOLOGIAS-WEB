<?php
require_once 'models/Book.php';

class BookController {

    // Listar todos los libros
    public function index() {
        $book = new Book();
        $result = $book->getAll();
        include 'views/index.php';
    }

    // Crear nuevo libro
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $book = new Book();
            $book->title = $_POST['title'];
            $book->author = $_POST['author'];
            $book->year = $_POST['year'];

            if ($book->create()) {
                header("Location: index.php");
            }
        }
        include 'views/create.php';
    }

    // Editar libro
    public function edit($id) {
        $book = new Book();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $book->id = $id;
            $book->title = $_POST['title'];
            $book->author = $_POST['author'];
            $book->year = $_POST['year'];

            if ($book->update()) {
                header("Location: index.php");
            }
        } else {
            $stmt = $book->getAll();
            $book = $stmt->fetch(PDO::FETCH_ASSOC);
            include 'views/edit.php';
        }
    }

    // Eliminar libro
    public function delete($id) {
        $book = new Book();
        $book->id = $id;
        if ($book->delete()) {
            header("Location: index.php");
        }
    }
}
?>
