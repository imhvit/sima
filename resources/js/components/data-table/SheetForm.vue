<script setup lang="ts" generic="T extends Record<string, any>">
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import {
    Sheet,
    SheetClose,
    SheetContent,
    SheetDescription,
    SheetFooter,
    SheetHeader,
    SheetTitle,
} from '@/components/ui/sheet';
import type { FormField } from '@/types';
import Spinner from '../ui/spinner/Spinner.vue';
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '../ui/select';
import type { InertiaForm } from '@inertiajs/vue3';

type Meta = {
    title: {
        edit: string;
        create: string;
    };
    description: {
        edit: string;
        create: string;
    };
};

const props = defineProps<{
    type: 'edit' | 'create';
    meta: Meta;
    form: InertiaForm<T>;
    fields: FormField<T>[];
    isLoading?: boolean;
}>();

const emit = defineEmits<{ (e: 'submit'): void }>();
</script>

<template>
    <Sheet>
        <SheetContent @interact-outside="(e) => e.preventDefault()">
            <SheetHeader>
                <SheetTitle>{{ meta.title[type] }}</SheetTitle>
                <SheetDescription>
                    {{ meta.description[type] }}
                </SheetDescription>
            </SheetHeader>

            <div
                v-if="isLoading"
                class="flex h-full flex-col items-center justify-center space-y-4"
            >
                <Spinner class="size-8" />
                <p class="animate-pulse text-sm text-muted-foreground">
                    Cargando información...
                </p>
            </div>

            <form
                v-else
                @submit.prevent="emit('submit')"
                class="flex h-full flex-col overflow-y-auto"
            >
                <div
                    class="grid flex-1 auto-rows-min gap-6 overflow-y-auto px-4"
                >
                    <template v-for="field in fields" :key="field.key">
                        <div class="group grid gap-3">
                            <Label :for="`sheet-form-${String(field.key)}`">
                                {{ field.label }}
                                <span
                                    v-if="field.required"
                                    class="text-destructive"
                                    >*</span
                                >
                            </Label>

                            <Input
                                v-if="field.type !== 'select'"
                                :id="`sheet-form-${String(field.key)}`"
                                v-model="form[field.key]"
                                :type="field.type || 'text'"
                                :min="field.min"
                                :step="field.step"
                                :required="field.required || false"
                                :placeholder="field.placeholder || ''"
                            />

                            <Select
                                v-else
                                :model-value="
                                    form[field.key]
                                        ? String(form[field.key])
                                        : undefined
                                "
                                @update:model-value="
                                    (val) => (form[field.key] = val as any)
                                "
                            >
                                <SelectTrigger
                                    :id="`sheet-form-${String(field.key)}`"
                                    class="w-full"
                                >
                                    <SelectValue
                                        :placeholder="
                                            field.placeholder ??
                                            'Selecciona una opción'
                                        "
                                    />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectItem
                                        v-for="opt in field.options"
                                        :key="opt.value"
                                        :value="String(opt.value)"
                                    >
                                        {{ opt.label }}
                                    </SelectItem>
                                </SelectContent>
                            </Select>

                            <span
                                v-if="
                                    form.errors[
                                        field.key as keyof typeof form.errors
                                    ]
                                "
                                class="text-xs font-medium text-destructive"
                            >
                                {{
                                    form.errors[
                                        field.key as keyof typeof form.errors
                                    ]
                                }}
                            </span>
                        </div>
                    </template>
                </div>

                <SheetFooter>
                    <SheetClose as-child>
                        <Button variant="outline" :disabled="form.processing">
                            Cerrar
                        </Button>
                    </SheetClose>
                    <Button type="submit" :disabled="form.processing">
                        <span
                            v-if="form.processing"
                            class="mr-2 h-4 w-4 animate-spin rounded-full border-2 border-current border-t-transparent"
                        ></span>
                        {{ form.processing ? 'Guardando...' : 'Guardar' }}
                    </Button>
                </SheetFooter>
            </form>
        </SheetContent>
    </Sheet>
</template>
