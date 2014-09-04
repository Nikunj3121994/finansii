<?php

class ArticlesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /articles
	 *
	 * @return Response
	 */
	public function index()
	{
        return ProcessResponse::process(Article::with('tariffs')->with('units')->get());
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /articles/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /articles
	 *
	 * @return Response
	 */
	public function store()
	{
        $validator = Validator::make(Input::all(), array(
            "tariff_code" => "required|numeric",
            "unit_id" => "required|numeric",
            "article_name" => "required"
        ));
        if($validator->fails()){
            return ProcessResponse::getError(1000,$validator->messages());
        }else{
            if(Article::create(Input::all())){
                return ProcessResponse::$success;
            }else{
                return ProcessResponse::getError( 1000,"Error");
            }
        }
	}

	/**
	 * Display the specified resource.
	 * GET /articles/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return ProcessResponse::process(Article::find($id)->with('tariffs')->with('units')->first());
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /articles/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /articles/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $validator = Validator::make(Input::all(), array(
            "tariff_code" => "numeric",
            "unit_id" => "numeric"
        ));
        if($validator->fails()){
            return ProcessResponse::getError(1000,$validator->messages());
        }else{
            $model=Article::find($id);
            $model->fill(Input::all());
            if($model->save()){
                return ProcessResponse::$success;
            }else{
                return ProcessResponse::getError( 1000,"Error");
            }
        }
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /articles/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Article::destroy($id);
	}

}