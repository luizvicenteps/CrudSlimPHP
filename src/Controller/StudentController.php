<?php

namespace App\Controller;


use App\Model\StudentModel;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class StudentController
{
    public static function index(ServerRequestInterface $request, ResponseInterface $response){
        global $app;

        $students = StudentModel::all();
        $dados = ['title' => 'Seja Bem Vindo'];

        return $app->getContainer()->get('renderer')->render($response, 'index.phtml', ['students' => $students, 'dados' => $dados]);
    }

    public static function create(ServerRequestInterface $request, ResponseInterface $response) {
        global $app;
        $dados = ['title' => 'Novo Aluno'];
        return $app->getContainer()->get('renderer')->render($response, 'create.phtml', ['students' => $students, 'dados' => $dados]);
    }

    public static function store(ServerRequestInterface $request, ResponseInterface $response){
        global $app;

        StudentModel::create($request->getParsedBody());
        $students = StudentModel::all();
        return $app->getContainer()->get('renderer')->render($response, 'index.phtml', ['students' => $students]);
    }

    public static function edit(ServerRequestInterface $request, ResponseInterface $response, $args){
        global $app;

        $student = StudentModel::find($args['id']);
        $dados = ['title' => 'Editar Aluno'];
        return $app->getContainer()->get('renderer')->render($response, 'edit.phtml', ['student' => $student, 'dados' => $dados]);
    }

    public static function update(ServerRequestInterface $request, ResponseInterface $response, $args){
        global $app;

        $student = StudentModel::find($args['id'])->update($request->getParsedBody());
        $students = StudentModel::all();
        return $app->getContainer()->get('renderer')->render($response, 'index.phtml', ['students' => $students]);
    }

    public static function delete(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        global $app;

        StudentModel::find($args['id'])->delete();
        $students = StudentModel::all();
        return $app->getContainer()->get('renderer')->render($response, 'index.phtml', ['students' => $students]);
    }

    // Métodos com Uso de Template
    public static function listaAlunos(ServerRequestInterface $request, ResponseInterface $response){
        global $app;

        $students = StudentModel::all();
        $dados = ['title' => 'Listagem de Alunos'];

        return $app->getContainer()->get('renderer')->render($response, 'listaAlunos.phtml', ['students' => $students, 'dados' => $dados]);
    }
    public static function login(ServerRequestInterface $request, ResponseInterface $response){
        global $app;

        
        return $app->getContainer()->get('renderer')->render($response, 'login.phtml', []);
    }
    
}