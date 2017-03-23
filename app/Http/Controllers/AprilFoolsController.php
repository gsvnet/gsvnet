<?php

/*

    April Fools 2017
    Authors of recent threads/replies get switched.
    Only authors that recently posted are included to avoid suspicion.
    To increase confusion, a user will not be shown switches involving his/her account.
    This way, users can only find out something is wrong by judging other people's posts.

*/

use Cache;
use Carbon\Carbon;
use GSVnet\Users\User;
use GSVnet\Users\UsersRepository;

class AprilFoolsController extends BaseController {

    protected $users;

    public function __construct( UsersRepository $users )
    {
        $this->users = $users;
    }

    public function index()
    {
        $this->authorize('admin');
        $victims = $this->getVictims();
        $activeUsers = $this->getTodaysActiveUsers();
        
        $canModify = Auth::user()->profile->profession == "Yoghurt";

        return view( 'AprilFools', compact( 'victims', 'activeUsers', 'canModify' ));
    }

    //Meant to be used for initializing the april fools table.
    //Not to be used after this goes public as so many threads/replies changing owners will likely raise suspicion
    public function resetTable()
    {
        $this->authorize('admin');
        DB::table( 'april_fools' )->truncate();

        $victims = $this->getActiveUsers();

        $this->swapAndInsert( $victims );

        return redirect()->action('AprilFoolsController@index');
    }

    //Meant to be used to add people to the april fools table that werent active enough in the last few days but are active now, after it goes live
    //This could be automated but whatever
    public function addActiveToTable()
    {
        $this->authorize('admin');
        $actives = $this->getTodaysActiveUsers();
        $victims = array();

        //Check whether the user is allready a victim of identity theft
        foreach( $actives as $active ) {
            $inTable = DB::table( 'april_fools' )
                ->where( 'author_id', '=', $active->id )
                ->orWhere( 'identity_id', '=', $active->id )
                ->count();
            
            if( !$inTable ) {
                array_push( $victims, $active );
            }
        }

        if( count( $victims ) >1 ){
            $this->swapAndInsert( $victims );
        }

        return redirect()->action('AprilFoolsController@index');
    }

    private function swapAndInsert( $victims )
    {
        $victims = $this->swapIdentities( $victims );
        
        foreach( $victims as $victim ) {
            DB::table( 'april_fools' )->insert(
                ['author_id' => $victim->id, 'identity_id' => $victim->identity->id]
            );
        }
    }

    // Shuffles array, making sure no value keeps its old index, if possible
    private function shuffleArray ( $array )
    {
        if( count( $array ) < 2 ) return $array;

        $array2 = $array;
        while( count( array_intersect_assoc( $array, $array2 ))) {
            shuffle( $array2 );
            /*var_dump('Array1:', $array);
            echo '<br/>';
            var_dump('Array2:', $array2);
            echo '<br/>';*/
        }
        return $array2;
    }

    //Get users that were most active in the last 2 weeks
    private function getActiveUsers( $num = 30 )
    {
        $now = (new Carbon);
        $to = $now->format('Y-m-d 23:59:59');
        $from = $now->subDays(13)->format('Y-m-d 00:00:00');
        $users = User::select(\DB::raw('count(forum_replies.author_id) as num, users.id, users.username, users.type, users.firstname, users.middlename, users.lastname'))
            ->join('forum_replies', 'users.id', '=', 'forum_replies.author_id')
            ->groupBy('forum_replies.author_id')
            ->whereBetween('forum_replies.created_at', [$from, $to])
            ->orderBy('num', 'DESC')
            ->take($num)
            ->get();

        return $users;
    }

    private function getTodaysActiveUsers( $num = 20 )
    {
        $now = (new Carbon);
        $from = $now->format('Y-m-d 00:00:00');
        $to = $now->format('Y-m-d 23:59:59');
        $users = User::select(\DB::raw('count(forum_replies.author_id) as num, users.id, users.username, users.type, users.firstname, users.middlename, users.lastname'))
            ->join('forum_replies', 'users.id', '=', 'forum_replies.author_id')
            ->groupBy('forum_replies.author_id')
            ->whereBetween('forum_replies.created_at', [$from, $to])
            ->orderBy('num', 'DESC')
            ->take($num)
            ->get();

        return $users;
    }

    private function swapIdentities( $victims )
    {
        $victimIds = array_map( function( $v ) { 
            return $v['id']; 
        }, is_array($victims) ? $victims : $victims->toArray() );

        $shuffledIds = $this->shuffleArray( $victimIds );

        foreach( $victims as $index=>$victim ) {
            $identity = User::find( $shuffledIds[$index] );
            $victim->identity = $identity;
        }

        return $victims;
    }

    private function getVictims()
    {
        $swaps = DB::table( 'april_fools' )->get();
        $victims = array();

        foreach ( $swaps as $index => $swap ) {
            $victim = User::find( $swap->author_id );
            $victim->identity = User::find( $swap->identity_id );
            array_push( $victims, $victim );
        }

        return $victims;
    }
}