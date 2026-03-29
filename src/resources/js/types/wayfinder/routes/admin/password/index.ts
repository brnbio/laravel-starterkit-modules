import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../wayfinder'
/**
* @see \Admin\Http\Controllers\AuthController::request
* @see modules/module-admin/app/Http/Controllers/AuthController.php:51
* @route '/admin/forgot-password'
*/
export const request = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: request.url(options),
    method: 'get',
})

request.definition = {
    methods: ["get","head"],
    url: '/admin/forgot-password',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Admin\Http\Controllers\AuthController::request
* @see modules/module-admin/app/Http/Controllers/AuthController.php:51
* @route '/admin/forgot-password'
*/
request.url = (options?: RouteQueryOptions) => {
    return request.definition.url + queryParams(options)
}

/**
* @see \Admin\Http\Controllers\AuthController::request
* @see modules/module-admin/app/Http/Controllers/AuthController.php:51
* @route '/admin/forgot-password'
*/
request.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: request.url(options),
    method: 'get',
})

/**
* @see \Admin\Http\Controllers\AuthController::request
* @see modules/module-admin/app/Http/Controllers/AuthController.php:51
* @route '/admin/forgot-password'
*/
request.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: request.url(options),
    method: 'head',
})

/**
* @see \Admin\Http\Controllers\AuthController::email
* @see modules/module-admin/app/Http/Controllers/AuthController.php:56
* @route '/admin/forgot-password'
*/
export const email = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: email.url(options),
    method: 'post',
})

email.definition = {
    methods: ["post"],
    url: '/admin/forgot-password',
} satisfies RouteDefinition<["post"]>

/**
* @see \Admin\Http\Controllers\AuthController::email
* @see modules/module-admin/app/Http/Controllers/AuthController.php:56
* @route '/admin/forgot-password'
*/
email.url = (options?: RouteQueryOptions) => {
    return email.definition.url + queryParams(options)
}

/**
* @see \Admin\Http\Controllers\AuthController::email
* @see modules/module-admin/app/Http/Controllers/AuthController.php:56
* @route '/admin/forgot-password'
*/
email.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: email.url(options),
    method: 'post',
})

/**
* @see \Admin\Http\Controllers\AuthController::reset
* @see modules/module-admin/app/Http/Controllers/AuthController.php:69
* @route '/admin/reset-password/{token}'
*/
export const reset = (args: { token: string | number } | [token: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: reset.url(args, options),
    method: 'get',
})

reset.definition = {
    methods: ["get","head"],
    url: '/admin/reset-password/{token}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Admin\Http\Controllers\AuthController::reset
* @see modules/module-admin/app/Http/Controllers/AuthController.php:69
* @route '/admin/reset-password/{token}'
*/
reset.url = (args: { token: string | number } | [token: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { token: args }
    }

    if (Array.isArray(args)) {
        args = {
            token: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        token: args.token,
    }

    return reset.definition.url
            .replace('{token}', parsedArgs.token.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \Admin\Http\Controllers\AuthController::reset
* @see modules/module-admin/app/Http/Controllers/AuthController.php:69
* @route '/admin/reset-password/{token}'
*/
reset.get = (args: { token: string | number } | [token: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: reset.url(args, options),
    method: 'get',
})

/**
* @see \Admin\Http\Controllers\AuthController::reset
* @see modules/module-admin/app/Http/Controllers/AuthController.php:69
* @route '/admin/reset-password/{token}'
*/
reset.head = (args: { token: string | number } | [token: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: reset.url(args, options),
    method: 'head',
})

/**
* @see \Admin\Http\Controllers\AuthController::store
* @see modules/module-admin/app/Http/Controllers/AuthController.php:77
* @route '/admin/reset-password'
*/
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/admin/reset-password',
} satisfies RouteDefinition<["post"]>

/**
* @see \Admin\Http\Controllers\AuthController::store
* @see modules/module-admin/app/Http/Controllers/AuthController.php:77
* @route '/admin/reset-password'
*/
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \Admin\Http\Controllers\AuthController::store
* @see modules/module-admin/app/Http/Controllers/AuthController.php:77
* @route '/admin/reset-password'
*/
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

const password = {
    request: Object.assign(request, request),
    email: Object.assign(email, email),
    reset: Object.assign(reset, reset),
    store: Object.assign(store, store),
}

export default password