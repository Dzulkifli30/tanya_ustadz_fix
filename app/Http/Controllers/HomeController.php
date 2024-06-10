<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function admin()
    {
        $show = User::where('name', '!=', 'admin')->get();

        return view('admin', compact('show'));
    }
    public function ustadz()
    {
        $show = Content::whereNull('jawaban')->latest()->paginate(2);
        $user = Auth::user();
        return view('ustadz', compact('show', 'user'));
    }

    public function updateuser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = Auth::user();
        $user->name = $request->name;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('dash.ustadz')->with('success', 'Profil berhasil diperbarui');
    }
    public function addUser(Request $request)
    {
        $user=User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('hayangjajan'),
        ]);
        $user->assignRole('ustadz');
        $rules = array(
            'nama' => 'required|string',
            'email' => 'required|unique|max:255',
        );
        $cek = Validator::make($request->all(),$rules);
        return redirect()->route('dash.admin')->with(['success' => 'Data Berhasil Disimpan!']);

    }
    public function destroy($id)
    {
        $ustadz = User::findOrFail($id);
        $ustadz->delete();

        return redirect()->back()->with('success', 'Ustadz berhasil dihapus.');
    }
}
