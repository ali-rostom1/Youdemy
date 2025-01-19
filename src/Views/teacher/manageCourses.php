<?php include "../src/Views/components/header.php"; ?>

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Manage Courses</h1>
    
    <div id="coursesData" data-courses='<?php echo $courseDataJson ?>'>
        <div class="space-y-4">
            <?php foreach ($courses as $course): ?>
                <div class="course-item bg-indigo-50 rounded-lg p-4 flex justify-between items-center">
                    <div>
                        <h3 class="text-xl font-semibold text-indigo-800"><?php echo $course->title ?></h3>
                        <p class="text-indigo-600"><?php echo $course->category ?></p>
                    </div>
                    <div class="space-x-2">
                        <a href="/course/edit?id=<?php echo $course->id ?>" 
                           class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                            Edit
                        </a>
                        <button onclick="deleteCourse(<?php echo $course->id ?>)" 
                                class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                            Delete
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script>
function deleteCourse(id) {
    if (confirm('Are you sure you want to delete this course?')) {
        window.location.href = `/course/delete?id=${id}`;
    }
}
</script>

<?php include "../src/Views/components/footer.php"; ?>