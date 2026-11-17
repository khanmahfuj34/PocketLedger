<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;
use OpenApi\Attributes as OA;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    #[OA\Get(
        path: '/profile',
        operationId: 'getProfile',
        summary: 'View user profile and statistics',
        description: 'Retrieves current authenticated user details and aggregated counts for transactions, budgets, and categories.',
        tags: ['Profile'],
        security: [['cookieAuth' => []]],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Profile data retrieved successfully'
            ),
            new OA\Response(
                response: 401,
                description: 'Unauthenticated',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
        ]
    )]
    public function edit(): View
    {
        $user = Auth::user();

        $stats = [
            'transactionsCount' => $user->transactions()->count(),
            'budgetsCount' => $user->budgets()->count(),
            'categoriesCount' => $user->categories()->count(),
            'memberSince' => $user->created_at ? $user->created_at->format('M d, Y') : 'N/A',
        ];

        return view('profile.edit', compact('user', 'stats'));
    }

    /**
     * Update the user's profile information.
     */
    #[OA\Put(
        path: '/profile',
        operationId: 'updateProfile',
        summary: 'Update user profile details',
        description: 'Updates account name and email address for the authenticated user.',
        tags: ['Profile'],
        security: [['cookieAuth' => []], ['csrfToken' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            description: 'Updated profile information',
            content: new OA\JsonContent(ref: '#/components/schemas/UpdateProfileRequest')
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Profile updated successfully'
            ),
            new OA\Response(
                response: 302,
                description: 'Profile updated. Redirecting with success flash.'
            ),
            new OA\Response(
                response: 401,
                description: 'Unauthenticated',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
            new OA\Response(
                response: 422,
                description: 'Validation error (e.g. email already registered to another user)',
                content: new OA\JsonContent(ref: '#/components/schemas/ValidationError')
            ),
        ]
    )]
    public function update(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
        ]);

        $user->fill($validated);
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profile information updated successfully.');
    }

    /**
     * Update the user's password.
     */
    #[OA\Put(
        path: '/profile/password',
        operationId: 'updatePassword',
        summary: 'Change user account password',
        description: 'Validates existing password and changes the account password to a new confirmed value.',
        tags: ['Profile'],
        security: [['cookieAuth' => []], ['csrfToken' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            description: 'Password modification payload',
            content: new OA\JsonContent(ref: '#/components/schemas/UpdatePasswordRequest')
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Password changed successfully'
            ),
            new OA\Response(
                response: 302,
                description: 'Password updated. Redirecting with success flash.'
            ),
            new OA\Response(
                response: 401,
                description: 'Unauthenticated',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
            new OA\Response(
                response: 422,
                description: 'Validation error (e.g. incorrect current password, confirmation mismatch)',
                content: new OA\JsonContent(ref: '#/components/schemas/ValidationError')
            ),
        ]
    )]
    public function updatePassword(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = Auth::user();
        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('profile.edit')->with('success', 'Password updated successfully.');
    }
}

