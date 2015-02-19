<?php namespace GSV\Http\Requests;

class ReplyToThreadRequest extends Request {

	public function authorize()
	{
        return true;
    }

	public function rules()
	{
		return [
            'body'  => 'required'
		];
	}

    public function validator()
    {

    }
}
