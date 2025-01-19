<?php include "../src/Views/components/header.php"; ?>

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Create New Course</h1>
    
    <form action="/course/create" method="POST" class="max-w-2xl">
        <div class="space-y-4">
            <div>
                <label class="block text-indigo-700">Course Title</label>
                <input type="text" name="title" required 
                       class="w-full p-2 border border-indigo-300 rounded">
            </div>
            
            <div>
                <label class="block text-indigo-700">Category</label>
                <select name="category" required 
                        class="w-full p-2 border border-indigo-300 rounded">
                    <option value="Programming">Programming</option>
                    <option value="Design">Design</option>
                    <option value="Business">Business</option>
                </select>
            </div>
            
            <div>
                <label class="block text-indigo-700">Description</label>
                <textarea name="description" required 
                          class="w-full p-2 border border-indigo-300 rounded"></textarea>
            </div>
            
            <button type="submit" 
                    class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                Create Course
            </button>
        </div>
    </form>
</div>

<?php include "../src/Views/components/footer.php"; ?>