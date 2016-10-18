<?php namespace App\Http\Controllers;

use App\Clockwork\Request;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->addSampleClockworkData();
    }

    protected function addSampleClockworkData()
    {
        session([ 'registration' => [
            'login' => 'kuli@shadowfall.eu',
            'password' => 'desmond',
            'first_name' => 'Kuli',
            'last_name' => 'Desmond'
        ]]);

        clock()->info(['hello' => 'world'], [ 'some' => 'context' ]);

        clock()->debug('Connecting to a database.');

        clock()->startEvent('database_query', 'Database query', microtime(true) - 0.012);

        app('db')->connection('clockwork')->table('clockwork')->count();
        $lastRequest = Request::on('clockwork')->latest()->first();

        clock($lastRequest);

        clock()->endEvent('database_query');

        clock()->error('Database returned no rows!');

        clock()->info('Calling the API.');

        clock()->startEvent('expensive_api_call', 'Api call', microtime(true) - 0.021);
        clock()->endEvent('expensive_api_call');

        clock()->warning('API call took more than 20 ms.');

        clock()->debug('API response:');
        clock()->debug([
        	'data' => [
        		[
        			'first_name' => 'Igor',
        			'last_name' => 'Timko',
        			'rating' => 420
        		],
        		[
        			'first_name' => 'Ivan',
        			'last_name' => 'Tasler',
        			'rating' => 366
        		],
        	]
        ]);
    }
}
