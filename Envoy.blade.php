@servers(['web' => 'iot.petra.ac.id'])

@task('deploy')
    cd /path/to/site
    git pull origin master
@endtask
