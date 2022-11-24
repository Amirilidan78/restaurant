adminTime=1

function admin_files_changed()
{
  files1=`find ./layouts -mmin -$adminTime`
  files2=`find ./layouts -mmin -$adminTime`
  files3=`find ./pages -mmin -$adminTime`
  files4=`find ./middleware -mmin -$adminTime`
  files5=`find ./assets -mmin -$adminTime`
  files6=`find ./pages -mmin -$adminTime`
  files7=`find ./plugins -mmin -$adminTime`
  files8=`find ./static -mmin -$adminTime`
  files9=`find ./store -mmin -$adminTime`
  files10=`find ./Dockerfile -mmin -$adminTime`
  files11=`find ./package.json -mmin -$adminTime`
  files12=`find ./package.json -mmin -$adminTime`

  # if any of files changed
  if [ \( ! -z "$files1" \) -o \( ! -z "$files2" \) -o \( ! -z "$files3" \) -o \( ! -z "$files4" \) -o \( ! -z "$files5" \) -o \( ! -z "$files6" \) -o \( ! -z "$files7" \) -o \( ! -z "$files8" \) -o \( ! -z "$files9" \) -o \( ! -z "$files10" \) -o \( ! -z "$files11" \) -o \( ! -z "$files12" \)  ]
  then
    return 1
  else
    return 0
  fi
}

if admin_files_changed $1 ; then
    echo $1
else
    echo "0"
fi
