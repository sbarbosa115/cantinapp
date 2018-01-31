<?php

namespace App\Http\Controllers\Restaurant;

use App\Employee;
use Illuminate\Http\Request;
use Validator;

class EmployeeController extends Controller
{
    /**
     *
     */
    public function index(){
        $items = Employee::all();
        return view('restaurant.employee.index', ['items' => $items]);
    }

    /**
     * Return the view to store a product.
     */
    public function create(){
        return view('restaurant.employee.create', ["item" => new Employee()]);
    }


    /**
     * Store validate and store a product in database.
     * @param Request $request User request object.
     * @return Redirect if all is good to controller index otherwise self-redirect with errors.
     */
    public function store(Request $request){
        request()->validate([
            'name' => 'required',
            'username' => 'required|unique:employees',
            'password' => 'required|min:6',
            'email' => 'email|unique:employees',
            'birth_date' => 'nullable|date_format:"Y-m-d"',
        ]);

        Employee::create($request->all());

        $request->session()->flash('success', 'The action was completed successfully.');

        return redirect()->route("restaurant.employee.index");
    }


    /**
     * Return the view to edit a employee.
     * @param $id Database product identifier.
     * @return $this View to edit the product.
     */
    public function edit($id){
        $item = Employee::findOrFail($id);

        return view('restaurant.employee.edit', ["item" => $item]);
    }


    /**
     * Validate and store the employee.
     * @param Request $request
     * @param $id Database employee identifier.
     * @return $this
     */
    public function update(Request $request, $id){
        request()->validate([
            'name' => 'required',
            'username' => "required|unique:employees,username,{$id}",
            'email' => "email|unique:employees,email,{$id}",
            'birth_date' => 'nullable|date_format:"Y-m-d"',
        ]);

        Employee::findOrFail($id)->update($request->all());

        $request->session()->flash('success', 'The action was completed successfully.');

        return redirect()->route("restaurant.employee.index");
    }

    /**
     * Remove employee from database.
     * @param Request $request Request object.
     * @param $id Employee id.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $id){
        $item = Employee::findOrFail($id);

        $item->delete();

        $request->session()->flash('success', 'The action was completed successfully.');
        return redirect()->route("restaurant.employee.index");
    }

}
