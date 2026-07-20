import type { Product, User, Warehouse } from '@/types';

export interface InventoryMovementRelations {
    warehouse: Warehouse;
    product: Product;
    user: User;
}

export interface InventoryMovement {
    id: number;
    warehouse_id: number;
    product_id: number;
    user_id: number;
    type: string;
    quantity: number;
    stock_before: number;
    stock_after: number;
    reference_type: string;
    reference_id: number;
    reason: string;
    notes: string;
    created_at: string;
    updated_at: string;
    deleted_at: string | null;
}

export type InventoryMovementTable = Pick<
    InventoryMovement,
    | 'id'
    | 'warehouse_id'
    | 'product_id'
    | 'user_id'
    | 'type'
    | 'quantity'
    | 'stock_before'
    | 'stock_after'
    | 'reason'
    | 'notes'
> &
    InventoryMovementRelations;

export type InventoryMovementWithRelations = InventoryMovement &
    InventoryMovementRelations;
