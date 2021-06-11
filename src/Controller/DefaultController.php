<?php

declare(strict_types=1);
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


//AbstractController es un controlador de Symfony
//que pone a disposición nuestra multitud de caracteristicas
class DefaultController extends AbstractController
{
    const PEOPLE = [
        ['name' => 'Carlos', 'email' => 'carlos@correo.com', 'age' => 30, 'city' => 'Benalmádena'],
        ['name' => 'Carmen', 'email' => 'carmen@correo.com', 'age' => 25, 'city' => 'Fuengirola'],
        ['name' => 'Carmelo', 'email' => 'carmelo@correo.com', 'age' => 35, 'city' => 'Torremolinos'],
        ['name' => 'Carolina', 'email' => 'carolina@correo.com', 'age' => 38, 'city' => 'Málaga'],
    ];

    /**
     * @Route("/default", name="default_index")
     * La clase ruta debe estar precedida en los comentarios por una @
     * El primer parámetro de Route es la URL a la que queremos asociar la acción.
     * El segundo parámetro de Route es el nombre que queremos dar a la ruta
     */
    public function index(): Response 
    {
        //Una acción siempre debe devolver una respuesta.
        //Por defecto deberá ser un objeto de la clase
        //Symfony\Component\HttpFoundation\Response;
        
        //render() es un método heredado de AbstractControoller
        //que devuelve el contenido declarado en una plantilla de Twig
        // https://twig.symfony.com/doc/3.x/templates.html

        //symfony console es un comando equivalente a php bin/console

        $name = 'Loli';

        return $this->render('default/index.html.twig', [
            'nombre'=>$name
        ]);   
    }
    /**
     * @Route("/saludo", name="default_saludo")
     */
    public function Saludo(): Response {
        return new Response('<html><body>hola</body></html>');
    }

     /**
     * @Route("/json", name="default_index_json")
     */
    public function indexJson(): JsonResponse {
        return new JsonResponse(self::PEOPLE);
    }

   
}