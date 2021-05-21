<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Models\Blog;
use Validator;

class BlogController extends Controller
{
    private $noOfRecordPerPage = 10;
    private $paginate = false;
    /**
     * Store a newly created User in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $input = $request->all();
        $validator = Validator::make($request->all(), [
            "title" => "required|unique:blogs,title",
            "slug" => "required|string|alpha_dash|unique:blogs,slug|regex:/^\S*$/u",
            "description" => "required",
        ]);
        if ($validator->fails()) {
            return Helper::errorResponse($validator->errors()->first(), 422, $validator->errors()->all());
        }

        try {
            $blogData = [
                "title" => $input['title'],
                "slug" => $input['slug'],
                "description" => $input['description'],
            ];
            
            $blog = Blog::create($blogData);
            $data = array(
                "blog" => $blog
            );
            return Helper::successResponse($data, "Successfully Created blog.");
        } catch (\Exception $e) {
            return Helper::errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function update(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            "id" => "required|exists:blogs,id",
            "title" => "required|unique:blogs,title," . $input['id'] . ",id",
            "slug" => "required|string|alpha_dash|unique:blogs,slug," . $input['id'] . ",id|regex:/^\S*$/u",
            "description" => "required",
        ]);
        if ($validator->fails()) {
            $errors[] = $validator->errors();
            return Helper::errorResponse($validator->errors()->first(), 422, $validator->errors()->all());
        }

        try {
            $blogData = [
                "title" => $input['title'],
                "slug" => $input['slug'],
                "description" => $input['description'],
            ];

            $blog = Blog::find($input['id']);
            $blog->update($blogData);

            $data = array(
                "blog" => $blog
            );
            return Helper::successResponse($data, 'Successfully Record Updated.');
        } catch (\Exception $e) {
            return Helper::errorResponse($e->getMessage(), $e->getCode());
        }
    }
    
    public function list(Request $request)
    {
        $input = $request->only('search', 'page', 'pagination', 'perPage');
        try {
            $blog = new Blog();
            // search
            if ((isset($input['search']) && $input['search'] != "")) {
                $blog = $blog->search($input['search']);
            }
            // pagination
            if (isset($input['perPage']) && $input['perPage'] != "") {
                $blog = $blog->latest()->paginate($input['perPage']);
            } else {
                $blog = $blog->latest()->paginate($this->noOfRecordPerPage);
            }
            // data
            return Helper::successResponse($blog, 'Successfully Get Blog.');
        } catch (\Exception $e) {
            return Helper::errorResponse($e->getMessage(), $e->getCode());
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            "id" => "required|exists:blogs,id,deleted_at,NULL",
        ]);

        if ($validator->fails()) {
            return Helper::errorResponse($validator->errors()->first(), 422,$validator->errors()->all());
        }
        try {
            $blog = Blog::find($input['id']);
            $blog->delete();
            
            $data = array(
                "blog" => $blog
            );

            return Helper::successResponse($data, 'Successfully Record Updated.');
        } catch (\Exception $e) {
            return Helper::errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function get(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            "id" => "required|exists:blogs,id,deleted_at,NULL",
        ]);

        if ($validator->fails()) {
            return Helper::errorResponse($validator->errors()->first(), 422,$validator->errors()->all());
        }
        try {
            $blog = Blog::find($input['id']);
            
            $data = array(
                "blog" => $blog
            );

            return Helper::successResponse($data, 'Successfully Record Updated.');
        } catch (\Exception $e) {
            return Helper::errorResponse($e->getMessage(), $e->getCode());
        }
    }
}
