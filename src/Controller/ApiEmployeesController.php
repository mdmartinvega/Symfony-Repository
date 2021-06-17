<?php

namespace App\Controller;


use App\Entity\Employee;
use App\Repository\EmployeeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/amazing-employees", name="api_employees_")
 */

class ApiEmployeesController extends AbstractController
{
    /**
     * @Route(
     *      "", 
     *      name="cget",
     *      methods={"GET"})
     */
    public function index(Request $request, EmployeeRepository $employeeRepository): Response
    {
        if($request->query->has('term')) {
            $people = $employeeRepository->findByTerm($request->query->get('term'));
            return $this->json($people);
        }

        return $this->json($employeeRepository->findAll());
    }

     /**
     * @Route(
     *      "/{id}", 
     *      name="get",
     *      methods={"GET"},
     *      requirements={
     *          "id": "\d+"  
     *      }
     * ) 
     * Cualquier dígito del 1 al 9 y el + que se puede repetir
     */

    

    public function show(Employee $employee): Response
    {
        return $this->json($employee);
    }


    /**
     * @Route(
     *      "",
     *      name="post",
     *      methods={"POST"}
     * )
     */

    public function add(): Response
    {
        $employee = new Employee();

        $employee->setName('Luis');
        $employee->setEmail('luis@correo.com');
        $employee->setAge(37);
        $employee->setCity('Málaga');
        $employee->setPhone('632451789');

        dump($employee);

        return $this->json([
            'method' => 'POST',
            'description' => 'Crea un recurso empleado',
        ]);
    }


    /**
     * @Route(
     *      "/{id}",
     *      name="put",
     *      methods={"PUT"},
     *      requirements={
     *      "id": "\d+" 
     *      }
     * )
     * Cualquier dígito del 1 al 9 y el + que se puede repetir
     */

    public function update(int $id): Response
    {
        return $this->json([
            'method' => 'PUT',
            'description' => 'Actualiza un recurso empleado con id: '.$id.'.',
        ]);
    }

     /**
     * @Route(
     *      "/{id}",
     *      name="delete",
     *      methods={"DELETE"},
     *      requirements={
     *          "id": "\d+"
     *      }
     * )
     * Cualquier dígito del 1 al 9 y el + que se puede repetir
     */

    public function remove(int $id): Response
    {
        return $this->json([
            'method' => 'DELETE',
            'description' => 'Elimina un recurso empleado con id: '.$id.'.',
        ]);
    }

}
