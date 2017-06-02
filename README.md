> 使用`file_put_contents()`进行操作，通过指定的地址和文件名称进行本地日志的写入

- 需要指定相关的目录的权限

notice:
### 提供两种方法进行日志的写入
- `basePrintLog($info,$src,$folderName,$file)`
    - 基础打印方法，使用此方法打印基础的输出信息（默认包含ip和时间信息）
    - `$info`为需要输出打印的信息
    - `$src`为输出的文件地址信息，可以不指定，默认地址为www服务器根目录`public/`文件夹中
    - `$folderName`为输出的文件路径中的文件夹，默认地址为`base/`
    - `$file`为输出的文件的文件前缀，输出格式为“前缀_日期”即一天为一个文件输出，默认为`base_日期`

- `debugPrintLog($info,$src,$folderName,$file)`
    - 会在基础输出信息的同时，同时默认输出哪一行调用的log方法等debug调试
    - `$src`为输出的文件地址信息，可以不指定，默认地址为www服务器根目录`public/`文件夹中
    - `$folderName`为输出的文件路径中的文件夹，默认地址为`debug/`
    - `$file`为输出的文件的文件前缀，输出格式为“前缀_日期”即一天为一个文件输出，默认为`base_日期`
