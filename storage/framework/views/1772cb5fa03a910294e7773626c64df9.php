<?php if (isset($component)) { $__componentOriginalb6ae7b16225a8198d83db1c2d27f7827 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb6ae7b16225a8198d83db1c2d27f7827 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.better','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('better'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="py-4">
        <!-- Flash message -->
        <?php if(session('success')): ?>
            <div id="flash-message" class="bg-green-100 text-green-800 p-3 rounded mb-4 mx-4">
                <?php echo e(session('success')); ?>

            </div>

            <script>
                // Hide the flash message after 5 seconds (5000ms)
                setTimeout(() => {
                    const msg = document.getElementById('flash-message');
                    if (msg) {
                        msg.style.transition = "opacity 0.5s ease-out";
                        msg.style.opacity = 0;
                        setTimeout(() => msg.remove(), 500); // Remove from DOM after fade
                    }
                }, 5000);
            </script>
        <?php endif; ?>
        <div class="max-w-auto mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <h1 class="text-2xl mb-4"><?php echo e($post->title); ?></h1>
                <?php if (isset($component)) { $__componentOriginal5e4137c8dcbbbe8998541a262cc3871e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5e4137c8dcbbbe8998541a262cc3871e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.user-card','data' => ['post' => $post]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('user-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['post' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($post)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5e4137c8dcbbbe8998541a262cc3871e)): ?>
<?php $attributes = $__attributesOriginal5e4137c8dcbbbe8998541a262cc3871e; ?>
<?php unset($__attributesOriginal5e4137c8dcbbbe8998541a262cc3871e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5e4137c8dcbbbe8998541a262cc3871e)): ?>
<?php $component = $__componentOriginal5e4137c8dcbbbe8998541a262cc3871e; ?>
<?php unset($__componentOriginal5e4137c8dcbbbe8998541a262cc3871e); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginalbb3bf1c36b50de6b8888029722a80a1c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbb3bf1c36b50de6b8888029722a80a1c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.engagement-bar','data' => ['post' => $post]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('engagement-bar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['post' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($post)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbb3bf1c36b50de6b8888029722a80a1c)): ?>
<?php $attributes = $__attributesOriginalbb3bf1c36b50de6b8888029722a80a1c; ?>
<?php unset($__attributesOriginalbb3bf1c36b50de6b8888029722a80a1c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbb3bf1c36b50de6b8888029722a80a1c)): ?>
<?php $component = $__componentOriginalbb3bf1c36b50de6b8888029722a80a1c; ?>
<?php unset($__componentOriginalbb3bf1c36b50de6b8888029722a80a1c); ?>
<?php endif; ?>

                <!-- Content Section -->
                <div class="mt-8">
                    <img src="<?php echo e(Storage::url($post->image)); ?>" alt="<?php echo e($post->title); ?>" class="w-full">

                    <div class="mt-4">
                        <?php echo e($post->content); ?>

                    </div>
                </div>

                <div class="mt-8">
                    <span class="px-4 py-2 bg-gray-200 rounded-2xl">
                        <?php echo e($post->category->name); ?>

                    </span>
                </div>
                <?php if(auth()->guard()->check()): ?>
                <!-- Comments Section -->
                <div class="mt-8" x-data="{liked : false  , content: '', post_id: <?php echo e($post->id); ?>,
                    comments: <?php echo e($post->comments->load('user')->toJson()); ?>,
                    errors: {},
                    submitting:false }">
                                        <h2 class="text-xl mb-4">Comments</h2>

                                        <!-- 2. The List (Displays all users' comments) -->
                                        <div class="mt-8 space-y-6">
                                            <template x-for="comment in comments" :key="comment.id">
                                                <div class="border-b pb-4">
                                                    <div class="flex items-center mb-2">
                                                        <img :src="'/storage/' + comment.user.avatar.replace('public/', '')"
                                                            class="h-8 w-8 rounded-full mr-2">
                                                        <span class="font-bold" x-text="comment.user.name"></span>
                                                    </div>
                                                    <p class="text-gray-600" x-text="comment.content"></p>
                                                    <div class="mt-3 w-full h-10 flex justify-between">

                                                        <div >
                                                            <span @click="liked = !liked"
                                                                class="flex items-center hover:scale-110 transition-transform cursor-pointer">
                                                                <svg x-show="liked" xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor" class="bi bi-hand-thumbs-up"
                                                                    viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2 2 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a10 10 0 0 0-.443.05 9.4 9.4 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a9 9 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.2 2.2 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.9.9 0 0 1-.121.416c-.165.288-.503.56-1.066.56z" />
                                                                </svg>
                                                                <svg x-show="!liked" xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor" class="bi bi-hand-thumbs-up-fill"
                                                                    viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a10 10 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733q.086.18.138.363c.077.27.113.567.113.856s-.036.586-.113.856c-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.2 3.2 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.8 4.8 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z" />
                                                                </svg>
                                                            </span>
                                                        </div>

                                                        <span class="flex cursor-pointer" @click="content ='@'+ comment.user.username">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                fill="currentColor" class="bi bi-reply" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M6.598 5.013a.144.144 0 0 1 .202.134V6.3a.5.5 0 0 0 .5.5c.667 0 2.013.005 3.3.822.984.624 1.99 1.76 2.595 3.876-1.02-.983-2.185-1.516-3.205-1.799a8.7 8.7 0 0 0-1.921-.306 7 7 0 0 0-.798.008h-.013l-.005.001h-.001L7.3 9.9l-.05-.498a.5.5 0 0 0-.45.498v1.153c0 .108-.11.176-.202.134L2.614 8.254l-.042-.028a.147.147 0 0 1 0-.252l.042-.028zM7.8 10.386q.103 0 .223.006c.434.02 1.034.086 1.7.271 1.326.368 2.896 1.202 3.94 3.08a.5.5 0 0 0 .933-.305c-.464-3.71-1.886-5.662-3.46-6.66-1.245-.79-2.527-.942-3.336-.971v-.66a1.144 1.144 0 0 0-1.767-.96l-3.994 2.94a1.147 1.147 0 0 0 0 1.946l3.994 2.94a1.144 1.144 0 0 0 1.767-.96z" />
                                                            </svg>
                                                            reply
                                                        </span>

                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                        <form @submit.prevent="

                                                                submitting = true;
                                                                errors = {};
                                                                axios.post('/comment', { content: content, post_id: post_id })
                                                                .then(res => { 
                                            content = ''; 
                                            // If you want to see the new comment immediately, add it here:
                                            comments.push(res.data.comment);
                                            })
                                            .catch(err => { 
                                            if (err.response.status === 422) {
                                            errors = err.response.data.errors;
                                            }
                                            })
                                            .finally(() => submitting = false);">
                                            <textarea x-model="content" rows="4" class="w-full p-2 border rounded mb-2" 
                                                :class="errors.content ? 'border-red-500' : 'border-gray-300'"
                                                placeholder="Add a comment...">
                                                                                                                                                                                </textarea>

                                            <template x-if="errors.content">
                                                <p class="text-red-500 text-sm mb-2" x-text="errors.content[0]"></p>
                                            </template>

                                            <button type="submit" :disabled="submitting"
                                                class="rounded mt-2 bg-[#79af9d] text-white px-4 py-2 disabled:opacity-50">
                                                <span x-show="!submitting">Submit Comment</span>
                                                <span x-show="submitting">Saving...</span>
                                            </button>
                                        </form>
                                    </div>
                <?php endif; ?>
                
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb6ae7b16225a8198d83db1c2d27f7827)): ?>
<?php $attributes = $__attributesOriginalb6ae7b16225a8198d83db1c2d27f7827; ?>
<?php unset($__attributesOriginalb6ae7b16225a8198d83db1c2d27f7827); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb6ae7b16225a8198d83db1c2d27f7827)): ?>
<?php $component = $__componentOriginalb6ae7b16225a8198d83db1c2d27f7827; ?>
<?php unset($__componentOriginalb6ae7b16225a8198d83db1c2d27f7827); ?>
<?php endif; ?><?php /**PATH E:\Laravel-2026\forum\resources\views/posts/show.blade.php ENDPATH**/ ?>