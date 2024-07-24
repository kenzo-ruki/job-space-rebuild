<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Page;
use Carbon\Carbon;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PageController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param Page    $page    Model
     * @param Request $request Request
     *
     * @return View
     */
    public function single(Page $page, Request $request): View
    {
        if (!$page->active || $page->published_at > Carbon::now()) {
            throw new NotFoundHttpException();
        }
        $template = $page->layout ? $page->slug : 'default';
        $page->load('seo');
        $seo = $page;
        return view('pages.' . $template, compact('page', 'seo'));
    }
}
