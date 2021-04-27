


const routes = [
    {
        path: '/',
        component: 'home'
    },
    {
        path: 'books',
        component: 'book',
        children:[
            {
                path:':id',
                component:'singlebooks'
            }
        ]
    },
    {
        path:'chart',
        component:'chart'
    },
    {
        path:'checkout',
        component:'checkout'
    },
    {
        path:'auth',
        component:'auth'
    }
]