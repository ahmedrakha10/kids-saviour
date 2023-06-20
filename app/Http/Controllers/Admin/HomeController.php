<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aqar;
use App\Models\AqarAddition;
use App\Models\AqarOrder;
use App\Models\AqarTips;
use App\Models\AqarType;
use App\Models\Article;
use App\Models\City;
use App\Models\CommentReport;
use App\Models\OrderService;
use App\Models\Package;
use App\Models\PaymentMethod;
use App\Models\Region;
use App\Models\Report;
use App\Models\Role;
use App\Models\Service;
use App\Models\Tag;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {

        return view('admin.home');

    }// end of index

    public function topStatistics()
    {

        $aqarTypesCount = number_format(AqarType::count(), 1);
        $PaymentMethodsCount = number_format(PaymentMethod::count(), 1);
        $citiesCount = number_format(City::count(), 1);
        $regionsCount = number_format(Region::count(), 1);
        $packagesCount = number_format(Package::count(), 1);
        $servicesCount = number_format(Service::count(), 1);
        $aqarTipsCount = number_format(AqarTips::count(), 1);
        $reportQuestionsCount = number_format(Report::count(), 1);
        $reportCommentsCount = number_format(CommentReport::count(), 1);
        $serviceOrderCount = number_format(OrderService::count(), 1);
        $aqarFeaturesCount = number_format(AqarAddition::count(), 1);
        $articlesCount = number_format(Article::count(), 1);
        $tagsCount = number_format(Tag::count(), 1);
        $aqarOrdersCount = number_format(Aqar::count(), 1);
        $ordersCount = number_format(AqarOrder::count(), 1);
        $draftCount = number_format(Aqar::whereStatus('draft')->count(), 1);
        $publishedCount = number_format(Aqar::whereStatus('published')->count(), 1);
        $unavailableCount = number_format(Aqar::whereStatus('unavailable')->count(), 1);
        $pendingCount = number_format(Aqar::whereStatus('pending')->count(), 1);
        $rejectedCount = number_format(Aqar::whereStatus('rejected')->count(), 1);
        $supervisorsCount = number_format(User::whereType('admin')->count(), 1);
        $usersCount = number_format(User::whereMembershipLevel('owner')->count(), 1);
        $companiesCount = number_format(User::whereMembershipLevel('company')->count(), 1);
        $rolesCount = number_format(Role::whereNotIn('name', ['super_admin', 'admin', 'user'])->count(), 1);

        return response()->json([
                                    'payment_methods_count'    => $PaymentMethodsCount,
                                    'aqar_types_count'         => $aqarTypesCount,
                                    'regions_count'            => $regionsCount,
                                    'cities_count'             => $citiesCount,
                                    'roles_count'              => $rolesCount,
                                    'tags_count'              => $tagsCount,
                                    'services_count'           => $servicesCount,
                                    'packages_count'           => $packagesCount,
                                    'aqar_tips_count'          => $aqarTipsCount,
                                    'supervisors_count'        => $supervisorsCount,
                                    'aqar_features_count'      => $aqarFeaturesCount,
                                    'service_orders_count'     => $serviceOrderCount,
                                    'report_questions_count'   => $reportQuestionsCount,
                                    'report_comments_count'    => $reportCommentsCount,
                                    'users_count'              => $usersCount,
                                    'companies_count'          => $companiesCount,
                                    'articles_count'           => $articlesCount,
                                    'aqar_orders_count'        => $aqarOrdersCount,
                                    'draft_orders_count'       => $draftCount,
                                    'published_orders_count'   => $publishedCount,
                                    'pending_orders_count'     => $pendingCount,
                                    'rejected_orders_count'    => $rejectedCount,
                                    'unavailable_orders_count' => $unavailableCount,
                                    'orders_count'             => $ordersCount,
                                ]);

    }

}//end of controller

