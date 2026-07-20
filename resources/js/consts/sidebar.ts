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
                url: '/app/catalog/categories',
            },
        ],
    },
    {
        title: 'Inventario',
        url: '/app/inventory',
        icon: Boxes,
        isActive: true,
        items: [
            {
                title: 'Stock',
                url: '/app/inventory/stock',
            },
            {
                title: 'Movimientos',
                url: '/app/inventory/movements',
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
