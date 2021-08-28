<?php

namespace App\Http\Controllers;

use App\Helpers\iCal;
use App\Helpers\Sitemap;
use App\Models\Date;
use App\Models\DateCategory;
use App\Models\Page;
use App\Notifications\Telegram\ErrorReport;
use App\Notifications\Telegram\HtmlText;
use App\Nova\Metrics\Referrer\ReferrerDomain;
use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\DNSCheckValidation;
use Egulias\EmailValidator\Validation\RFCValidation;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\View;

class DevelopmentController extends Controller
{
    protected string $tomorrow;
    protected string $dayAfterTomorrow;

    public function index()
    {
        //
    }

    public function getColumns(string $table)
    {
        return Schema::getColumnListing($table);
    }
}
