<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use OpenApi\Attributes as OA;

class AuthController extends Controller
{
    // Show Register Form
    public function showRegister()
    {
        return view('auth.register');
    }

    #[OA\Post(
        path: '/register',
        operationId: 'registerUser',
        summary: 'Register a new user',
        description: 'Creates a new user account, provisions default expense and income categories, starts an authenticated session, and redirects to dashboard.',
        tags: ['Authentication'],
        requestBody: new OA\RequestBody(
            required: true,
            description: 'User registration credentials',
            content: new OA\JsonContent(ref: '#/components/schemas/RegisterRequest')
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: 'User account created and authenticated'
            ),
            new OA\Response(
                response: 302,
                description: 'Registration successful. Redirecting to dashboard with session cookie.'
            ),
            new OA\Response(
                response: 422,
                description: 'Validation error',
                content: new OA\JsonContent(ref: '#/components/schemas/ValidationError')
            ),
        ]
    )]
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $user->createDefaultCategories();

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    // Show Login Form
    public function showLogin()
    {
        return view('auth.login');
    }

    #[OA\Post(
        path: '/login',
        operationId: 'loginUser',
        summary: 'Authenticate user credentials',
        description: 'Validates user email and password credentials, establishes authenticated session, and sets laravel_session cookie.',
        tags: ['Authentication'],
        requestBody: new OA\RequestBody(
            required: true,
            description: 'User login credentials',
            content: new OA\JsonContent(ref: '#/components/schemas/LoginRequest')
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Session authenticated successfully'
            ),
            new OA\Response(
                response: 302,
                description: 'Credentials verified. Redirecting to intended URL or dashboard with session cookie.'
            ),
            new OA\Response(
                response: 422,
                description: 'Invalid credentials or validation error',
                content: new OA\JsonContent(ref: '#/components/schemas/ValidationError')
            ),
        ]
    )]
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(route('dashboard'));
        }

        return back()
            ->withErrors([
                'email' => 'Invalid email or password.',
            ])
            ->onlyInput('email');
    }

    #[OA\Post(
        path: '/logout',
        operationId: 'logoutUser',
        summary: 'Log out authenticated user',
        description: 'Terminates active session, invalidates session cookie, and flushes CSRF token.',
        tags: ['Authentication'],
        security: [['cookieAuth' => []], ['csrfToken' => []]],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Session invalidated successfully'
            ),
            new OA\Response(
                response: 302,
                description: 'Session terminated. Redirecting to login route.'
            ),
            new OA\Response(
                response: 401,
                description: 'Unauthenticated',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
        ]
    )]
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}