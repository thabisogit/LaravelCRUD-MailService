<?php

namespace App\Http\Controllers;

    use App\User;
    use App\UserInterest;
    use App\UserInterestLink;
    use App\UserLanguage;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Mail;

class UserInterestController extends Controller
{
    /**
     * Pull a list of the users interests.
     *
     * @return array
     */
    public function interests(Request $request)
    {
        $interestsArray = [];
        $interests = UserInterestLink::where('user_id',$request->user_id)->get();
        foreach ($interests as $interest){
            $interestName = UserInterest::where('id', $interest->getAttributes()['user_interest_id'])->pluck('interest');
            $interestsArray[] = $interestName[0];
        }
        return $interestsArray;

    }
}
