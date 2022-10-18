<?php declare(strict_types=1);

namespace Drupal\custom_console_logging;

use Monolog\Formatter\JsonFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Log to the console pipe in JSON.
 */
class ConsoleLoggingHandler extends StreamHandler {

  /**
   * Default sink.
   *
   * @var string
   */
  const SINK = '/var/log/console';

  /**
   * Constructor; this is mostly the same as the parent, except we opt-in to
   * JsonFormatter instead of the default LineFormatter.
   *
   * @param resource|string|null $stream
   *   Resource or filename to write.
   * @param int $level
   *   The minimum logging level at which this handler will be triggered
   * @param bool $bubble
   *   Whether the messages that are handled can bubble up the stack or not
   * @param int|null $filePermission
   *   Optional file permissions (default (0644) are only for owner read/write)
   * @param bool $useLocking
   *   Try to lock log file before doing any writes
   *
   * @throws \Exception
   *   If a missing directory is not buildable
   * @throws \InvalidArgumentException
   *   If stream is not a resource or string
   */
  public function __construct($stream = NULL, int $level = Logger::WARNING, bool $bubble = TRUE, ?int $filePermission = NULL, bool $useLocking = FALSE) {
    // Stream option is polymorphic so account for nullability here.
    if (is_null($stream)) {
      $stream = getenv('LOGGING_SINK') ?: self::SINK;
    }
    parent::__construct($stream, $level, $bubble, $filePermission, $useLocking);
  }

}
