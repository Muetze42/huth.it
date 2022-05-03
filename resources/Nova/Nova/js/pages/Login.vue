<template>
    <div>
        <Head :title="__('Log In')"/>

        <form
            @submit.prevent="attempt"
            class="bg-white dark:bg-gray-800 shadow rounded-lg p-8 max-w-[25rem] mx-auto"
        >
            <h2 class="text-2xl text-center font-normal mb-6 text-90">
                {{ __('Welcome Back!') }}
            </h2>

            <DividerLine/>

            <div class="mb-6">
                <label class="block mb-2" for="email">{{ __('Email Address') }}</label>
                <input
                    v-model="form.email"
                    class="form-control form-input form-input-bordered w-full"
                    :class="{ 'form-input-border-error': form.errors.has('email') }"
                    id="email"
                    type="email"
                    name="email"
                    autofocus=""
                    required
                />

                <HelpText class="mt-2 text-red-500" v-if="form.errors.has('email')">
                    {{ form.errors.first('email') }}
                </HelpText>
            </div>

            <div class="mb-6">
                <label class="block mb-2" for="password">{{ __('Password') }}</label>
                <input
                    v-model="form.password"
                    class="form-control form-input form-input-bordered w-full"
                    :class="{ 'form-input-border-error': form.errors.has('password') }"
                    id="password"
                    type="password"
                    name="password"
                    required
                />

                <HelpText class="mt-2 text-red-500" v-if="form.errors.has('password')">
                    {{ form.errors.first('password') }}
                </HelpText>
            </div>

            <div class="flex mb-6">
                <label class="flex items-center block text-xl">
                    <input v-model="form.remember" type="checkbox" name="remember"/>
                    <span class="text-base ml-2">{{ __('Remember me') }}</span>
                </label>

                <div
                    v-if="supportsPasswordReset || forgotPasswordPath !== false"
                    class="ml-auto"
                >
                    <Link
                        v-if="forgotPasswordPath === false"
                        :href="$url('/password/reset')"
                        class="text-gray-500 font-bold no-underline"
                        v-text="__('Forgot your password?')"
                    />
                    <a
                        v-else
                        :href="forgotPasswordPath"
                        class="text-gray-500 font-bold no-underline"
                        v-text="__('Forgot your password?')"
                    />
                    <a
                        v-else
                        :href="forgotPasswordPath"
                        class="text-gray-500 font-bold no-underline"
                        v-text="__('Forgot your password?')"
                    />
                </div>
            </div>

            <DefaultButton class="w-full flex justify-center" type="submit">
                <span>
                    {{ __('Log In') }}
                </span>
            </DefaultButton>
            <a href="/auth/github"
               class="mt-4 w-full flex justify-center shadow relative bg-primary-500 hover:bg-primary-400 active:bg-primary-600 text-white dark:text-gray-900 w-full flex justify-center cursor-pointer rounded text-sm font-bold focus:outline-none focus:ring inline-flex items-center justify-center h-9 px-3 w-full flex justify-center shadow relative bg-primary-500 hover:bg-primary-400 active:bg-primary-600 text-white dark:text-gray-900 w-full flex justify-center">
                <i class="fa-brands fa-github fa-fw"></i>{{ __('Log In via GitHub') }}
            </a>
        </form>
    </div>
</template>

<script>
import Auth from '@/layouts/Auth'

export default {
    name: 'LoginPage',

    layout: Auth,

    data: () => ({
        form: Nova.form({
            email: '',
            password: '',
            remember: false,
        }),
    }),

    methods: {
        async attempt() {
            const {redirect} = await this.form.post(Nova.url('/login'))

            if (redirect !== undefined && redirect !== null) {
                window.location.href = redirect
            }

            Nova.visit('/')
        },
    },

    computed: {
        supportsPasswordReset() {
            return Nova.config('withPasswordReset')
        },

        forgotPasswordPath() {
            return Nova.config('forgotPasswordPath')
        },
    },
}
</script>
