<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head></head>
	<body>
		A new job has been submitted by: {{ $submitted_by }}

		<p>
			{!! $description !!}
		</p>

		<p>Click <a href="{{ env('APP_URL') . '/job-posts/' . $id . '/published?_token=' . $token }}">here</a> to publish the job posting</p>
		<p>Click <a href="{{ env('APP_URL') . '/job-posts/' . $id . '/spam?_token=' . $token }}">here</a> to mark as spam</p>
	</body>
</html>