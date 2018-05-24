<?php

namespace App;

class Constant
{
	/* Banana Messages */
	const MSG_CLI_NOT_FOUND = 'Client database error not found';

	/* Status Code */
	const OK = 200;
	const INTERNAL_SERVER_ERROR = 500;
	const NOT_IMPLEMENTED = 501;

	/* Success DB Message */
	const MSG_SUCCESS = 'Created successfully';

	/* Error Codes DB */
    const TOO_LONG = 1406;
    const DUPLICATE = 1062;
    const TB_NOT_FOUND = 1146;

    /* Error Codes DB Messages */
    const MSG_ERROR_DB = 'Error in database';
    const MSG_TOO_LONG = 'Data too long';
    const MSG_DUPLICATE = 'It already exists';
    const MSG_TB_NOT_FOUND = 'Table not found';
}