export type InputType = 'text' | 'number' | 'boolean' | 'textarea' | 'select';

export interface SelectOption {
    label: string;
    value: string | number;
}

export interface FormField<T> {
    key: keyof T;
    label: string;
    type: InputType;
    required?: boolean;
    min?: number;
    step?: number;
    placeholder?: string;
    options?: SelectOption[];
}
