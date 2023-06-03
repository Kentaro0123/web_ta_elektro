@servers(['web' => 'iot.petra.ac.id'])

@task('deploy')
    ls -a 
@endtask

@task('clone_code')
    git clone 
@endtask
