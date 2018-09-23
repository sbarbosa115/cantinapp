<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Requests\EmployeeStoreRequest;
use App\Model\Employee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    /**
     *
     */
    public function index(): View
    {
        $items = Employee::all();
        return view('restaurant.employee.index', ['items' => $items]);
    }

    public function create(): View
    {
        return view('restaurant.employee.create', ['item' => new Employee()]);
    }

    public function store(EmployeeStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        Employee::create($data);
        $request->session()->flash('success', 'The action was completed successfully.');
        return redirect()->route('restaurant.employee.index');
    }

    public function edit($id): View
    {
        $item = Employee::findOrFail($id);
        return view('restaurant.employee.edit', ['item' => $item]);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        request()->validate([
            'name' => 'required',
            'username' => "required|unique:employees,username,{$id}",
            'email' => "email|unique:employees,email,{$id}",
            'birth_date' => 'nullable|date_format:"Y-m-d"',
        ]);

        Employee::findOrFail($id)->update($request->all());
        $request->session()->flash('success', 'The action was completed successfully.');

        return redirect()->route('restaurant.employee.index');
    }

    public function destroy(Request $request, $id): RedirectResponse
    {
        $item = Employee::findOrFail($id);
        $item->delete();
        $request->session()->flash('success', 'The action was completed successfully.');
        return redirect()->route('restaurant.employee.index');
    }

}
