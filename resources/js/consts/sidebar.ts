import {
    Home,
    Package,
    Boxes,
    Warehouse,
    ShoppingCart,
    FileBarChart,
    Settings,
} from '@lucide/vue';

export const NAV_MAIN = [
    {
        title: 'Panel de control',
        url: '/app/dashboard',
        icon: Home,
    },
    {
        title: 'Catálogo',
        url: '/app/catalog',
        icon: Package,
        isActive: true,
        items: [
            {
                title: 'Productos',
                url: '/app/catalog/products',
            },
            {
                title: 'Categorías',
                url: '#',
            },
        ],
    },
    {
        title: 'Inventario',
        url: '#',
        icon: Boxes,
        isActive: true,
        items: [
            {
                title: 'Stock',
                url: '#',
            },
            {
                title: 'Movimientos',
                url: '#',
            },
        ],
    },
    {
        title: 'Almacenes',
        url: '#',
        icon: Warehouse,
    },
    {
        title: 'Compras',
        url: '#',
        icon: ShoppingCart,
        isActive: true,
        items: [
            {
                title: 'Órdenes de Compra',
                url: '#',
            },
            {
                title: 'Proveedores',
                url: '#',
            },
        ],
    },
    {
        title: 'Reportes',
        url: '#',
        icon: FileBarChart,
    },
    {
        title: 'Configuración',
        url: '#',
        icon: Settings,
    },
];
