import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../wayfinder'
/**
* @see \Portal\Http\Controllers\HomeController::__invoke
* @see modules/module-portal/app/Http/Controllers/HomeController.php:11
* @route '/'
*/
export const home = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: home.url(options),
    method: 'get',
})

home.definition = {
    methods: ["get","head"],
    url: '/',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Portal\Http\Controllers\HomeController::__invoke
* @see modules/module-portal/app/Http/Controllers/HomeController.php:11
* @route '/'
*/
home.url = (options?: RouteQueryOptions) => {
    return home.definition.url + queryParams(options)
}

/**
* @see \Portal\Http\Controllers\HomeController::__invoke
* @see modules/module-portal/app/Http/Controllers/HomeController.php:11
* @route '/'
*/
home.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: home.url(options),
    method: 'get',
})

/**
* @see \Portal\Http\Controllers\HomeController::__invoke
* @see modules/module-portal/app/Http/Controllers/HomeController.php:11
* @route '/'
*/
home.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: home.url(options),
    method: 'head',
})

const portal = {
    home: Object.assign(home, home),
}

export default portal