<?php

namespace App;

class Constant
{
	/* Status Code */
	const OK = 200;
	const INTERNAL_SERVER_ERROR = 500;
	const NOT_IMPLEMENTED = 501;

	/* Success Message */
	const MSG_SUCCESS = 'Created successfully';

	/* Error Codes DB */
    const TOO_LONG = 1406;
    const DUPLICATE = 1062;

    /* Error Codes Messages */
    const MSG_ERROR_DB = 'Error in database';
    const MSG_TOO_LONG = 'Data too long';
    const MSG_DUPLICATE = 'It already exists';
}
