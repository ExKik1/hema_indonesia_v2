<?php

namespace App\Http\Controllers;

use App\Models\CategoriesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DataMasterController extends Controller
{
    public function categoriesIndex()
    {
        $data = CategoriesModel::all();
        return view('categories.index', compact(['data']));
    }

    public function categoriesAdd()
    {
        return view('categories.add');
    }

    public function categoriesStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'category_code' => 'unique:categories,category_code',
            'description' => 'required'
        ], [
            'name.required' => 'Input nama kategori harus diisi',
            'category_code.unique' => 'Kode kategori tersebut sudah tersedia',
            'description.required' => 'Input deskripsi kategori harus diisi',
        ]);

        if ($validator->fails()) return redirect('/categories/add-categories')->withErrors($validator)->withInput();

        CategoriesModel::create([
            'name' => $request->input('name'),
            'category_code' => $request->input('category_code'),
            'description' => $request->input('description')
        ]);

        Session::flash('success', 'Tambah kategori produk berhasil');
        return redirect('/categories');
    }

    public function categoriesEdit($category_code)
    {
        $data = CategoriesModel::where('category_code', $category_code)->firstOrFail();
        return view('categories.edit', compact('data'));
    }

    public function categoriesUpdate(Request $request, $category_code)
    {
        $data = CategoriesModel::where('category_code', $category_code)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required'
        ], [
            'name.required' => 'Input nama kategori harus diisi',
            'description.required' => 'Input deskripsi kategori harus diisi',
        ]);

        if ($validator->fails()) return redirect('/categories/edit-categories/' . strtolower($data->category_code))->withErrors($validator)->withInput();

        $data->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        Session::flash('success', 'Ubah kategori produk berhasil');
        return redirect('/categories');
    }

    public function categoriesDestroy($category_code)
    {
        $data = CategoriesModel::where('category_code', $category_code)->firstOrFail();
        $data->delete();
        Session::flash('success', 'Hapus kategori produk berhasil');
        return redirect('/categories');
    }
}