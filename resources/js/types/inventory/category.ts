export interface Category {
    id: number;
    name: string;
    description: string;
    is_active: boolean;
    created_at: string;
    updated_at: string;
    deleted_at: string;
}

export type CategoryTable = Pick<
    Category,
    'id' | 'name' | 'description' | 'is_active'
>;
