<?php

declare(strict_types=1);
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
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
    public function index(Request $solicitud): Response 
    {
        echo '<pre>query id: '; var_dump($solicitud->query->get('id')); echo '</pre>';
        // echo '<pre>request: '; var_dump($solicitud->request); echo '</pre>';
        // echo '<pre>server: '; var_dump($solicitud->server); echo '</pre>';
        // echo '<pre>file: '; var_dump($solicitud->files); echo '</pre>';

        //Una acción siempre debe devolver una respuesta.
        //Por defecto deberá ser un objeto de la clase
        //Symfony\Component\HttpFoundation\Response;
        
        //render() es un método heredado de AbstractControoller
        //que devuelve el contenido declarado en una plantilla de Twig
        // https://twig.symfony.com/doc/3.x/templates.html

        //symfony console es un comando equivalente a php bin/console

        $name = 'Loli';

        return $this->render('default/index.html.twig', [
            'people'=> self::PEOPLE
        ]);   
    }
    /**
     * @Route("/saludo", name="default_saludo")
     */
    public function Saludo(): Response {
        return new Response('<html><body>hola</body></html>');
    }

     /**
     * @Route(
     *      "/default.{_format}", 
     *      name="default_index_json",
     *      requirements = {
     *          "_format": "json"
     *      }
     * )
     * 
     * El comando:
     * symfony console router:match /default.json
     * buscará la acción coincidente con la ruta indicada 
     * y mostrará la información asociada
     */
    public function indexJson(): JsonResponse {
        // return $this->json(self::PEOPLE);Equivalente a lo de abajo
        return new JsonResponse(self::PEOPLE);
    }

     /**
     * @Route(
     *      "/default/{id}",
     *      name="default_show",
     *      requirements = {
     *          "id": "[0-3]"
     *      }
     * )
     */
    public function show(int $id): Response {
        // var_dump($id); die();
        return $this->render('default/show.html.twig', [
            'id' => $id,
            'person' => self::PEOPLE[$id]
        ]);
    }

    /**
     * @Route("/redirect-to-home", name="default_redirect_to_home")
     */

    public function redirectToHome(): Response {
        //Redirigir a la URL /
        // return $this->redirect('/');

        //Redirigir a una ruta utilizando su nombre
        // return $this->redirectToRoute('default_show', ['id' => 1]);

        //Devolver directamente un objeto RedirectResponse
        return new RedirectResponse('/', Response::HTTP_TEMPORARY_REDIRECT);

    }

    //EJERCICIO
    //Crear el recurso para obtener una representación
    //de UN empleado enb formato JSON

    /**
     * @Route(
     *      "/default.{_format}/{id}", 
     *      name="default_show_json",
     *      requirements = {
     *          "_format": "json",
     *          "id": "[0-3]"
     *      }
     * )
     * 
     * El comando:
     * symfony console router:match /default.json
     * buscará la acción coincidente con la ruta indicada 
     * y mostrará la información asociada
     */
    public function userJson(): JsonResponse {

        return $this->json(self::PEOPLE['id']);
        // return new JsonResponse(self::PEOPLE['id']);
    }
   
}