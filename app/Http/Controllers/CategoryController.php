<?php

namespace App\Http\Controllers;

use App\Exceptions\AppException;
use App\Helpers\ResponseHelper;
use App\Http\Requests\CreateCategoryRequest;
use App\Models\Category;
use App\Models\UserCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends BaseController
{
    public function create(CreateCategoryRequest $request)
    {
        // Validate the request data
        $validatedData = $request->validated();

        // Get the authenticated user ID
        $userId = Auth::id();

        // Create an array to store the created categories
        $createdCategories = [];

        foreach ($validatedData['categories'] as $categoryData) {
            // Create a new category instance
            $category = new Category();
            $category->name = $categoryData['name'];
            $category->parent_id = $categoryData['parent_id'];
            $category->file_id = $categoryData['file_id'];
            $category->is_active = $categoryData['is_active'];

            // Save the category to the database
            $category->save();

            // Create a user_category relationship for the authenticated user
            $userCategory = new UserCategory();
            $userCategory->user_id = $userId;
            $userCategory->category_id = $category->id;
            $userCategory->save();

            // Add the created category to the array
            $createdCategories[] = $category;
        }

        // Return a response with the created categories
        return $this->standardResponse('Categories created successfully', $createdCategories, null, 200);
    }

    public function index(Request $request)
    {
        $search = $request->query('search');

        $query = Category::with('children', 'file')->where('is_active', '=', 1);

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $categories = $query->paginate();

        return ResponseHelper::paginationResponse($categories);
    }
    public function updateStatus(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $status = $request->input('is_active', false);
        $category->is_active = $status;
        $category->save();

        return $this->standardResponse('Category status updated successfully', $category, null, 200);

    }
    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);

            if (!$category) {
                throw new AppException('Category not found');
            }

            // Delete the user_category relationships for the category
            UserCategory::where('category_id', $category->id)->delete();

            $category->delete();

            return $this->standardResponse('Category deleted successfully', $category, null, 200);
        } catch (AppException $exception) {
            return $this->standardResponse($exception->getMessage(), null, null, 400);
        }
    }

    public function getName()
    {
        $categories = Category::pluck('name');

        return response()->json([
            'message' => 'Category name retrieved successfully',
            'data' => [
                'category_name' => $categories,
            ],
        ]);
    }


}
