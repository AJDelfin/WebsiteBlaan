

<?php $__env->startSection('content'); ?>
<div class="pt-16 sm:pl-64">
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Student Management</h1>
        <!-- CRUD Table for Students -->
        <div x-data="crud">
            <!-- Add Student Button -->
            <button @click="openModal('student')" class="bg-blue-500 text-white px-4 py-2 rounded-md mb-4">Add Student</button>
            <!-- Students Table -->
            <table class="min-w-full bg-white border">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Name</th>
                        <th class="py-2 px-4 border-b">Email</th>
                        <th class="py-2 px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="student in students" :key="student.id">
                        <tr>
                            <td class="py-2 px-4 border-b" x-text="student.name"></td>
                            <td class="py-2 px-4 border-b" x-text="student.email"></td>
                            <td class="py-2 px-4 border-b">
                                <button @click="editItem('student', student)" class="bg-yellow-500 text-white px-2 py-1 rounded-md">Edit</button>
                                <button @click="deleteItem('student', student.id)" class="bg-red-500 text-white px-2 py-1 rounded-md ml-2">Delete</button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal for Adding/Editing Students -->
<div x-data="{ modalOpen: false, modalType: '', formData: { id: null, name: '', email: '' } }" x-show="modalOpen" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg w-1/3">
        <h3 class="text-xl font-bold mb-4" x-text="modalType === 'student' ? 'Student' : ''"></h3>
        <form @submit.prevent="submitForm">
            <div class="mb-4">
                <label class="block text-gray-700">Name</label>
                <input type="text" x-model="formData.name" class="w-full px-3 py-2 border rounded-md">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Email</label>
                <input type="email" x-model="formData.email" class="w-full px-3 py-2 border rounded-md">
            </div>
            <div class="flex justify-end">
                <button type="button" @click="modalOpen = false" class="bg-gray-500 text-white px-4 py-2 rounded-md mr-2">Cancel</button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Save</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('crud', () => ({
            students: [],

            init() {
                this.fetchStudents();
            },

            async fetchStudents() {
                const response = await fetch('/api/students'); // Replace with your API endpoint
                this.students = await response.json();
            },

            openModal(type) {
                this.modalType = type;
                this.modalOpen = true;
            },

            editItem(type, item) {
                this.formData = {
                    ...item
                };
                this.openModal(type);
            },

            async deleteItem(type, id) {
                if (confirm('Are you sure you want to delete this student?')) {
                    await fetch(`/api/students/${id}`, {
                        method: 'DELETE'
                    });
                    this.fetchStudents();
                }
            },

            async submitForm() {
                const url = this.formData.id ? `/api/students/${this.formData.id}` : '/api/students';
                const method = this.formData.id ? 'PUT' : 'POST';

                const response = await fetch(url, {
                    method,
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(this.formData)
                });

                if (response.ok) {
                    this.modalOpen = false;
                    this.fetchStudents();
                }
            }
        }));
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\Blaan_Multi_Role\resources\views/admin/student.blade.php ENDPATH**/ ?>