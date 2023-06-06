<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SignUp extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $signupError = false;
    public $signupErrorMsg = '';

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email:rfc,dns',
        'password' => 'required|min:6'
    ];

    public function mount() {
        if(auth()->user()){
            redirect('/dashboard');
        }
    }

    public function register() {
        $this->validate();
        $existingUser = User::where(['email'=>$this->email])->first();
        //dd($existingUser->active);
        if($existingUser) {
            if($existingUser->active==1)
            {
                $this->signupError=true;
                $this->signupErrorMsg='account already registered please Sign in..!';
            }else{
                $user = User::find($existingUser->id)->update([
                    'name' => $this->name,
                    'active' => 1,
                    'password' => Hash::make($this->password)
                ]);

                //auth()->login($user);

                return redirect('/dashboard');
            }
        }
        else
        {
            $this->signupError=true;
            $this->signupErrorMsg='account does not exist..!';
        }
    }

    public function render()
    {
        return view('livewire.auth.sign-up');
    }
}
