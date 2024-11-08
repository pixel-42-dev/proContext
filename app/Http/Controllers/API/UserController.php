<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Validation\ValidationException;

/**
 * Контроллер, отвечающий за операции CRUD для таблицы Users
 *
 * @author Vadim Tkachev
 */
class UserController extends Controller
{
    /**
     * Выводит всех пользователей
     *
     * @return JsonResponse Возвращает список всех пользователей в формате Json
     */
    public function index(): JsonResponse
    {
        $users = User::all();
        return response()->json($users, 201);
    }

    /**
     * Обрабатывает пользователя по его ID
     *
     * @param int $id id пользователя
     *
     * @return JsonResponse Возвращает пользователя в формате Json
     */
    public function show(int $id): JsonResponse
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Пользователь не найден'], 404);
        }

        return response()->json($user);
    }

    /**
     * Создаёт нового пользователя
     *
     * @param Request $request Входящий JSON с данными пользователя
     *
     * @return JsonResponse Возвращает добавленного пользователя в формате Json
     *
     * @throws ValidationException Ошибка валидации
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'age' => 'required|integer|min:0',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        }

        $user = User::create($validated);

        return response()->json($user, 201);
    }

    /**
     * Обновляет существующего пользователя
     *
     * @param Request $request Входящий JSON с данными пользователя
     *
     * @return JsonResponse Возвращает изменённого пользователя в формате Json
     *
     * @throws ValidationException Ошибка валидации
     */
    public function update(Request $request, $id): JsonResponse
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Пользователь не найден'], 404);
        }

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => [
                    'required',
                    'email',
                    'max:255',
                    'unique:users,email,' . $user->id,
                ],
                'age' => 'required|integer|min:0',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        }

        $user->update($validated);
        return response()->json($user);
    }

    /**
     * Удаляет пользователя
     *
     * @param int $id id пользователя
     *
     * @return JsonResponse Возвращает информацию об удалении
     */
    public function destroy(int $id): JsonResponse
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Пользователь не найден'], 404);
        }

        $user->delete();
        return response()->json(['message' => 'Пользователь успешно удалён'], 200);
    }
}
