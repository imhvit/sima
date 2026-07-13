import { Brand } from './brand';
import { Category } from './category';
import { Unit } from './unit';

export interface ProductRelations {
    category: Category;
    brand: Brand;
    unit: Unit;
}

export interface Product {
    id: number;
    category_id: number;
    brand_id: number;
    unit_id: number;
    sku: string;
    name: string;
    description: string;
    sale_price: number;
    minimum_stock: number;
    image: string | null;
    created_at: string;
    updated_at: string;
    deleted_at: string | null;
}

export type ProductTable = Pick<
    Product,
    'id' | 'sku' | 'name' | 'sale_price' | 'minimum_stock'
>;

export type ProductForm = Omit<
    Product,
    'id' | 'created_at' | 'updated_at' | 'deleted_at'
>;

export type ProductWithRelations = Product & ProductRelations;
