import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../wayfinder'
import loginDf2c2a from './login'
import password from './password'
/**
* @see \Admin\Http\Controllers\AuthController::login
* @see modules/module-admin/app/Http/Controllers/AuthController.php:25
* @route '/admin/login'
*/
export const login = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: login.url(options),
    method: 'get',
})

login.definition = {
    methods: ["get","head"],
    url: '/admin/login',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Admin\Http\Controllers\AuthController::login
* @see modules/module-admin/app/Http/Controllers/AuthController.php:25
* @route '/admin/login'
*/
login.url = (options?: RouteQueryOptions) => {
    return login.definition.url + queryParams(options)
}

/**
* @see \Admin\Http\Controllers\AuthController::login
* @see modules/module-admin/app/Http/Controllers/AuthController.php:25
* @route '/admin/login'
*/
login.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: login.url(options),
    method: 'get',
})

/**
* @see \Admin\Http\Controllers\AuthController::login
* @see modules/module-admin/app/Http/Controllers/AuthController.php:25
* @route '/admin/login'
*/
login.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: login.url(options),
    method: 'head',
})

/**
* @see \Admin\Http\Controllers\DashboardController::__invoke
* @see modules/module-admin/app/Http/Controllers/DashboardController.php:11
* @route '/admin'
*/
export const dashboard = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: dashboard.url(options),
    method: 'get',
})

dashboard.definition = {
    methods: ["get","head"],
    url: '/admin',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Admin\Http\Controllers\DashboardController::__invoke
* @see modules/module-admin/app/Http/Controllers/DashboardController.php:11
* @route '/admin'
*/
dashboard.url = (options?: RouteQueryOptions) => {
    return dashboard.definition.url + queryParams(options)
}

/**
* @see \Admin\Http\Controllers\DashboardController::__invoke
* @see modules/module-admin/app/Http/Controllers/DashboardController.php:11
* @route '/admin'
*/
dashboard.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: dashboard.url(options),
    method: 'get',
})

/**
* @see \Admin\Http\Controllers\DashboardController::__invoke
* @see modules/module-admin/app/Http/Controllers/DashboardController.php:11
* @route '/admin'
*/
dashboard.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: dashboard.url(options),
    method: 'head',
})

/**
* @see \Admin\Http\Controllers\AuthController::logout
* @see modules/module-admin/app/Http/Controllers/AuthController.php:42
* @route '/admin/logout'
*/
export const logout = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: logout.url(options),
    method: 'post',
})

logout.definition = {
    methods: ["post"],
    url: '/admin/logout',
} satisfies RouteDefinition<["post"]>

/**
* @see \Admin\Http\Controllers\AuthController::logout
* @see modules/module-admin/app/Http/Controllers/AuthController.php:42
* @route '/admin/logout'
*/
logout.url = (options?: RouteQueryOptions) => {
    return logout.definition.url + queryParams(options)
}

/**
* @see \Admin\Http\Controllers\AuthController::logout
* @see modules/module-admin/app/Http/Controllers/AuthController.php:42
* @route '/admin/logout'
*/
logout.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: logout.url(options),
    method: 'post',
})

const admin = {
    login: Object.assign(login, loginDf2c2a),
    password: Object.assign(password, password),
    dashboard: Object.assign(dashboard, dashboard),
    logout: Object.assign(logout, logout),
}

export default admin