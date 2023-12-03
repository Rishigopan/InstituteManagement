<div class="col-xl-6 col-lg-6 col-12">
    <label class="mt-2 mb-1 inputlabel">Course Provider</label><br>
    <select class="form-select inputfield " wire:model="selectedCourseProvider" wire:change="getCourse" aria-label="Default select example name"
        id="course_provider" name="CourseProvider" autofocus required>
        <option hidden class="inputlabel" value="" selected> Choose CourseProvider</option>
        @foreach ($Course as $key)
            <option class="inputlabel" value="{{ $key->id }}">{{ $key->provider_name }}
            </option>
        @endforeach
    </select>
</div>

<div class="col-xl-6 col-lg-6 col-12">
    <label class="mt-2 mb-1 inputlabel" >Course Name</label><br>

    <select class="form-select inputfield " wire:model="selectedCourse" aria-label="Default select example name"
        id="course_name" name="CourseName" autofocus required>
        <option hidden class="inputlabel" value=""> Choose Course</option>
        @foreach ($CourseName as $key)
            <option class="inputlabel" value="{{ $key->id }}">{{ $key->course_name }}
            </option>
        @endforeach
    </select>
</div>
